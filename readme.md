## 使用方法

### 项目根目录执行
```
$ github：git clone https://github.com/jahem/tp3.2_composer.git org
$ gitee：git clone https://gitee.com/jahem/tp3.2_composer.git org //国内github太慢，使用gitee
$ cd org
$ composer install
```

### 执行完后修改入口文件 index.php , 所有运行代码最上面增加
```
$ define('START_PATH',__DIR__);
$ require START_PATH.'/org/vendor/autoload.php'; //引入composer自动加载入口
``` 

### 所有操作完成，请尽情使用，后续的composer类库，可直接在org目录下执行
#### PS:注意安装的php版本问题，tp3.2 默认无法使用 5.6^,要用7.0需要修改mysql类或找低于5.6^的composer类，也还要注意依赖的
如:
```
$ cd org
$ composer require overtrue/wechat:~3.1 -vvv
```
