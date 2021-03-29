<?php

################################################################################
# Config
################################################################################

$name = trim(shell_exec('git config user.name'));
$email = trim(shell_exec('git config user.email'));
$pluginSlug = strtolower(basename(__DIR__));
$pluginName = ucwords(str_replace(['-', '_'], ' ', $pluginSlug));

$fields = [
    'author_name' => ['Your name', '', $name],
    'author_email' => ['Your email address', '', $email],
    'author_github_username' => ['Your Github username', '<username> in https://github.com/username', ''],
    'author_website' => ['Your website', '', 'https://github.com/{author_github_username}'],

    'vendor_name' => ['Vendor name', '', '{author_github_username}'],
    'vendor_github' => ['Vendor Github username', '<username> in https://github.com/username', '{vendor_name}'],

    'plugin_name' => ['Plugin name', '', $pluginName],
    'plugin_slug' => ['Plugin slug', 'Plugin name in slug format', $pluginSlug],
    'plugin_prefix' => ['Plugin prefix', 'Abbreviated shorthand ideally 3-5 characters', ''],
    'plugin_version' => ['Plugin version', '', '0.1.0'],
    'plugin_website' => ['Plugin website', '', 'https://github.com/{vendor_github}/{plugin_name}'],
    'plugin_description' => ['Brief description of plugin', '', ''],

    'psr4_namespace' => ['PSR-4 namespace', 'example: Vendor\\Plugin', ''],
];

$values = [];

$replacements = [
    ':vendor_name\\\\:plugin_name\\\\' => function () use (&$values) {
        return str_replace('\\', '\\\\', $values['psr4_namespace']) . '\\\\';
    },
    'PseudoVendor\\\\PseudoPlugin\\\\' => function () use (&$values) {
        return str_replace('\\', '\\\\', $values['psr4_namespace']) . '\\\\';
    },
    'PseudoVendor\\PseudoPlugin' => function () use (&$values) {
        return $values['psr4_namespace'];
    },
    'PseudoPlugin' => function () use (&$values) {
        return str_replace(['-', '_'], '', ucwords($values['plugin_name']));
    },
    'PseudoVersion' => function () use (&$values) {
        return str_replace('.', '_', $values['plugin_version']);
    },
    ':plugin_author' => function () use (&$values) {
        return $values['author_name'];
    },
    ':author_username' => function () use (&$values) {
        return $values['author_github_username'];
    },
    ':author_website' => function () use (&$values) {
        return $values['author_website'];
    },
    ':author_email' => function () use (&$values) {
        return $values['author_email'];
    },
    ':vendor_name' => function () use (&$values) {
        return $values['vendor_name'];
    },
    ':vendor_github' => function () use (&$values) {
        return $values['vendor_github'];
    },
    ':plugin_name' => function () use (&$values) {
        return $values['plugin_name'];
    },
    ':plugin_slug' => function () use (&$values) {
        return $values['plugin_slug'];
    },
    ':plugin_prefix' => function () use (&$values) {
        return $values['plugin_prefix'];
    },
    ':plugin_website' => function () use (&$values) {
        return $values['plugin_website'];
    },
    ':plugin_description' => function () use (&$values) {
        return $values['plugin_description'];
    },
    ':system_year' => function () {
        return date('Y');
    }
];

$root = __DIR__;
$prefill = $root . '/.prefill';

$files = array_merge(
    // service boilerplate
    glob($prefill . '/*.md'),
    glob($prefill . '/*.xml.dist'),
    glob($prefill . '/composer.json'),
    glob($prefill . '/package.json'),

    // php boilerplate
    glob($root . '/src/**/*.php'),
    glob($root . '/config/**/*.php'),
    glob($root . '/boot/development.php'),
    glob($root . '/tests/**/*.php')

    // js boilerplate

    // css boilerplate
);

// files to be relocated to a directory that is not the project root
$nonStandard = [];

// files whose contents should be merged with
$mergeJson = [
    'composer.json' => $root,
    'package.json' => $root . '/assets'
];

################################################################################
# Process
################################################################################

define('COL_DESCRIPTION', 0);
define('COL_HELP', 1);
define('COL_DEFAULT', 2);

$modify = 'n';
do {
    if ($modify == 'q') {
        exit;
    }

    $values = [];

    echo "----------------------------------------------------------------------\n";
    echo "Please, provide the following information:\n";
    echo "----------------------------------------------------------------------\n";
    foreach ($fields as $name => $field) {
        $default = isset($field[COL_DEFAULT]) ? interpolate($field[COL_DEFAULT], $values) : '';
        $prompt = sprintf(
            '%s%s%s: ',
            $field[COL_DESCRIPTION],
            $field[COL_HELP] ? ' (' . $field[COL_HELP] . ')' : '',
            $field[COL_DEFAULT] !== '' ? ' [' . $default . ']' : ''
        );
        $values[$name] = read_from_console($prompt);
        if (empty($values[$name])) {
            $values[$name] = $default;
        }
    }
    echo "\n";

    echo "----------------------------------------------------------------------\n";
    echo "Please, check that everything is correct:\n";
    echo "----------------------------------------------------------------------\n";
    foreach ($fields as $name => $field) {
        echo $field[COL_DESCRIPTION] . ": $values[$name]\n";
    }
    echo "\n";
} while (($modify = strtolower(read_from_console('Modify files with these values? [y/N/q] '))) != 'y');
echo "\n";

echo shell_exec('rm -rf .git') . "\n";
echo shell_exec('git init') . "\n";

echo "Updating file content\n";

foreach ($files as $file) {
    // create updated boilerplate
    $contents = file_get_contents($file);
    foreach ($replacements as $str => $func) {
        $contents = str_replace($str, $func(), $contents);
    }

    // merge json files
    if (isset($mergeJson[$file])) {
        $base = $mergeJson[$file] . '/' . $file;
        $old = json_decode(file_get_contents($base), true);
        $new = array_merge_recursive($old, $contents);
        file_put_contents($base, json_encode($new));
        continue;
    }

    // update boilerplate content
    file_put_contents($file, $contents);

    // copy non-standard files
    if (isset($nonStandard[$file])) {
        copy($file, $nonStandard[$file]);
        continue;
    }

    // copy standard files
    copy($file, $root);
}

// echo shell_exec('sed -i -e "/^\*\*Note:\*\* Replace/d" README.md') . "\n";

echo "All done! Going away now.\n";

shell_exec('rm ' . basename(__FILE__));

################################################################################
# Functions
################################################################################

function read_from_console($prompt)
{
    if (function_exists('readline')) {
        $line = trim(readline($prompt));
        if (!empty($line)) {
            readline_add_history($line);
        }
    } else {
        echo $prompt;
        $line = trim(fgets(STDIN));
    }
    return $line;
}

function interpolate($text, $values)
{
    if (!preg_match_all('/\{(\w+)\}/', $text, $m)) {
        return $text;
    }
    foreach ($m[0] as $k => $str) {
        $f = $m[1][$k];
        $text = str_replace($str, $values[$f], $text);
    }
    return $text;
}

function merge_composer_json($old, $new)
{
    return array_merge_recursive($old, $new);
}

function merge_package_json($old, $new)
{
    return array_merge_recursive($old, $new);
}
