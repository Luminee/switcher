# Luminee Switcher

Laravel数据库连接切换扩展包，支持动态切换默认数据库连接和添加额外连接配置。

## 功能特性

- 动态切换默认数据库连接
- 支持添加额外数据库连接配置
- 自动恢复原始连接
- 支持多层级连接配置

## 安装

通过Composer安装：

```bash
composer require luminee/switcher
```

## 配置

1. 发布配置文件：

```bash
php artisan vendor:publish --provider="Luminee\Switcher\SwitcherServiceProvider"
```

2. 在`config/switcher.php`中添加额外连接配置：

```php
return [
    'extra_connections' => [
        // 简单连接配置
        'mysql2' => [
            'driver' => 'mysql',
            'host' => '127.0.0.1',
            // 其他配置...
        ],
        
        // 多层级连接配置
        'project' => [
            'dev' => [
                'driver' => 'mysql',
                // 配置...
            ],
            'prod' => [
                'driver' => 'mysql',
                // 配置...
            ]
        ]
    ]
];
```

## 使用方法

### 基本用法

```php
use Luminee\Switcher\Facades\Switcher;

Switcher::run(function() {
    // 这里使用新连接执行操作
    return User::all();
}, 'mysql2');
```

### 使用多层级连接

```php
Switcher::run(function() {
    // 使用project_dev连接
    return User::all();
}, 'project_dev');
```

## 注意事项

1. 连接切换仅在闭包函数内有效
2. 操作完成后会自动恢复原始连接
3. 连接名称会自动转换为小写
4. 多层级连接会自动添加前缀（如`project_dev`）

## 开源协议

MIT