<?php

namespace App\Library\PluginSystem;

/**
 * Class PluginInfoScheme
 * Схема плагина
 *
 * @package App\Library\PluginSystem
 * @author Andrew Sementsov <thesunlightday@gmail.com>
 *
 * @property string $version Версия плагина (пакета)
 * @property array $components Компоненты пакета
 */
class PluginScheme
{
    public $scheme;
    public $package;
    public $vendor;

    public function __construct($path = null)
    {
        if ($path) {
            $this->load($path);
        }
    }

    /**
     * Загружает схему из файла
     *
     * @param string $content Содержимое файла схемы
     */
    public function load(string $content)
    {
        $this->scheme = json_decode($content);
    }

    /**
     * Проверка правилньости схемы
     *
     * @return bool
     */
    public function validate()
    {
        if ($this->scheme == null) {
            return false;
        }
        $object_vars = array_keys(get_object_vars($this->scheme));
        if (!in_array('version', $object_vars) || !in_array('components', $object_vars)) {
            return false;
        }
        if (!preg_match('/^(\d+\.\d+\.\d+)$/', $this->scheme->version)) {
            return false;
        }
        if (!is_array($this->scheme->components)) {
            return false;
        }

        return true;
    }

    /**
     * Получение свойств схемы
     *
     * @param string $name Название свойства схемы
     * @return mixed
     */
    public function __get($name)
    {
        return $this->scheme->$name;
    }
}
