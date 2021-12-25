<?php

namespace PseudoVendor\PseudoPlugin;

use Leonidas\Contracts\Extension\WpExtensionInterface;
use Leonidas\Enum\ExtensionType;
use Leonidas\Framework\Exceptions\InvalidCallToPluginMethodException;
use Leonidas\Framework\Helpers\Plugin;
use Leonidas\Framework\ModuleInitializer;
use Leonidas\Framework\WpExtension;
use PseudoVendor\PseudoPlugin\Facades\_Facade;
use Psr\Container\ContainerInterface;

final class Launcher
{
    /**
     * @var string
     */
    private $base;

    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $url;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var WpExtensionInterface
     */
    private $extension;

    /**
     * @var Launcher
     */
    private static $instance;

    private function __construct(string $base, string $path, string $url)
    {
        $this->base = $base;
        $this->path = $path;
        $this->url = $url;
        $this->container = $this->buildContainer();
        $this->extension = $this->buildExtension();
    }

    private function buildContainer(): ContainerInterface
    {
        return require $this->path . '/boot/container.php';
    }

    private function buildExtension(): WpExtensionInterface
    {
        $config = [$this->container->get('config'), 'get'];

        return WpExtension::create([
            'name' => $config('plugin.name'),
            'version' => $config('plugin.version'),
            'slug' => $config('plugin.slug'),
            'prefix' => $config('plugin.prefix'),
            'description' => $config('plugin.description'),
            'base' => $this->base,
            'path' => $this->path,
            'url' => $this->url,
            'assets' => $config('plugin.assets'),
            'dev' => $config('plugin.dev'),
            'type' => new ExtensionType('plugin'),
            'container' => $this->container,
        ]);
    }

    private function reallyReallyInit(): void
    {
        $this
            ->bindContainerToFacades()
            ->initializeModules()
            ->requestAssistance()
            ->launchPseudoPlugin();
    }

    private function bindContainerToFacades(): Launcher
    {
        _Facade::_setFacadeContainer($this->container);

        return $this;
    }

    private function initializeModules(): Launcher
    {
        (new ModuleInitializer(
            $this->extension,
            $this->extension->config('app.modules')
        ))->init();

        return $this;
    }

    private function requestAssistance(): Launcher
    {
        foreach ($this->extension->config('app.bootstrap', []) as $assistant) {
            (new $assistant($this->extension))->bootstrap();
        }

        return $this;
    }

    private function launchPseudoPlugin(): Launcher
    {
        PseudoPlugin::launch($this->extension);

        return $this;
    }

    public static function init(string $base): void
    {
        if (!self::isLoaded()) {
            self::reallyInit($base);
        } else {
            self::throwAlreadyLoadedException(__METHOD__);
        }
    }

    private static function isLoaded(): bool
    {
        return isset(self::$instance) && (self::$instance instanceof self);
    }

    private static function reallyInit(string $base): void
    {
        require dirname($base) . '/boot/init.php';

        $init = function () use ($base) {
            self::$instance = new self(
                Plugin::base($base),
                Plugin::path($base),
                Plugin::url($base)
            );

            self::$instance->reallyReallyInit();
        };

        if (did_action('leonidas_loaded')) {
            $init();
        } else {
            add_action('leonidas_loaded', $init);
        }
    }

    private static function throwAlreadyLoadedException(callable $method): void
    {
        throw new InvalidCallToPluginMethodException(
            self::$instance->extension->getName(),
            $method
        );
    }
}
