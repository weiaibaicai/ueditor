# Dcat Admin Extension  百度编辑器


## 依赖
 
- php  | >= 7.4.0
- dcat/laravel-admin  | >= ~2.0 


## 安装

### composer 安装

```
composer require weiaibaicai/ueditor
```


### 发布配置

```
php artisan vendor:publish --provider="Weiaibaicai\Ueditor\UeditorServiceProvider"
```

### 后台发布

```
开发工具 -> 扩展 -> weiaibaicai.ueditor -> 升级 -> 启用
```

## 方法使用

```
$form->ueditor('content');
```

## 安装问题
>1. 发布文件时可能存在权限问题，记得给足权限。我一般在项目根目录执行 `chmod -R 755 public/vendor`
