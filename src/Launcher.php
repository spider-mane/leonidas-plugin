<?php

namespace PseudoVendor\PseudoPlugin;

use Leonidas\Contracts\Extension\WpExtensionInterface;
use Leonidas\Enum\ExtensionType;
use Leonidas\Framework\Exceptions\PluginAlreadyLoadedException;
use Leonidas\Framework\ModuleInitializer;
use Leonidas\Framework\WpExtension;
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
            'prefix' => $config('plugin.prefix.short'),
            'description' => $config('plugin.description'),
            'base' => $this->base,
            'path' => $this->path,
            'url' => $this->url,
            'assets' => $config('plugin.assets'),
            'dev' => $config('plugin.dev'),
            'type' => new ExtensionType($config('plugin.type')),
            'container' => $this->container
        ]);
    }

    private function reallyReallyInit(): void
    {
        $this
            ->initializeModules()
            ->getFurtherAssistance()
            ->launchPseudoPlugin();
    }

    private function initializeModules(): Launcher
    {
        (new ModuleInitializer($this->extension, $this->getModules()))->init();

        return $this;
    }

    private function getModules(): array
    {
        return $this->extension->config('app.modules');
    }

    private function getFurtherAssistance(): Launcher
    {
        foreach ($this->extension->config('app.bootstrap', []) as $assistant) {
            (new $assistant($this->extension))->bootstrap();
        }

        return $this;
    }

    private function launchPseudoPlugin(): void
    {
        if (class_exists(PseudoPlugin::class)) {
            PseudoPlugin::launch($this->extension);
        }
    }

    public static function init(string $base, string $path, string $url): void
    {
        if (!self::isLoaded()) {
            self::reallyInit($base, $path, $url);
        }

        self::throwAlreadyLoadedException(__METHOD__);
    }

    private static function isLoaded(): bool
    {
        return isset(self::$instance) && (self::$instance instanceof self);
    }

    private static function reallyInit(string $base, string $path, string $url): void
    {
        self::$instance = new self($base, $path, $url);
        self::$instance->reallyReallyInit();
    }

    private static function throwAlreadyLoadedException(callable $method): void
    {
        throw new PluginAlreadyLoadedException(
            self::$instance->extension->getName(),
            $method
        );
    }
}
