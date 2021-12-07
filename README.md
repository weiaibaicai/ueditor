# Dcat Admin Extension  百度编辑器


## 依赖
 
- php  | >= 7.4.0
- dcat/laravel-admin  | >= ~2.0 


## 安装

### composer 安装
```
composer require weiaibaicai/ueditor
```


### 启用插件
```
开发工具 -> 扩展 -> weiaibaicai.ueditor -> 升级 -> 启用
```

### 发布配置 ueditor.php
```
php artisan vendor:publish --provider="Weiaibaicai\Ueditor\UeditorServiceProvider"
```

## 方法使用
```
$form->ueditor('content');
```

## 安装问题
1. 发布文件时可能存在权限问题，记得给足权限。我一般在项目根目录执行 `chmod -R 755 public/vendor`
2. 读取不到已经发布的配置，可清空一下缓存 `php artisan config:clear`
3. 上传图片失败，请检查存储配置是否设置好了
