# 关于 Vue + Laravel 前后端分离开发的Q&A

### Q：Vue框架的目录简析
A: 主要的开发工作都是在`src`文件夹里，里面的三个文件夹分别是：
* `assets` => 用来存储一些静态文件，例如项目要用到的图片；
* `components`=> 用来放置我们自定义的所有组件文件，组件文件以`.vue`结尾；
* `router`=> 里面有一个`index.js`文件，是整个项目的路由文件，相当于`laravel`项目中的`web.php`文件，用以定义整个应用项目内页面的路由跳转
`config`：文件夹顾名思义是配置文件，具体怎么配置根据具体情况而定；
`App.vue`：`Vue.js`框架的开发思想是组件式开发，则这个`App.vue`可以理解为整个项目的子组件都要依附的根组件
`main.js`: 是整个`Vue.js`项目的入口文件，挂载`App.vue`根组件文件，然后通过`router`从`index.js`文件引入我们自定义的组件，从而完成整个项目的渲染
`index.html`：应该不用细说，看名字就知道是干什么的了，没有它就没有界面

### Q：定义了多个自己的组件，怎么都引入到一个页面里
A: 我们从`index.js`文件的示例写法来看，可以发现应用内的一个界面的路由定义只能引入一个组件，那么此时我们可以再定义一个父组件，父组件包含自己定义的多个自己的组件
例如：`TodoApp.vue`
```javascript
import Todo from './Todo'
import TodoForm from './TodoForm'

export default {
  name: 'todoApp',
  components: {Todo, TodoForm},
...
```
每个界面有一个自己的父组件，然后在`index.js`里添加路由配置即可，即此时引入`TodoApp.vue`，
例如：`index.js`
```javascript
import TodoApp from '../components/TodoApp.vue'
...
routes: [
    {
      path: '/',
      name: 'TodoApp',
      component: TodoApp
    }
  ]
...
```

### Q：如果用上面的那一问方法的话，这个父组件不是和App.vue处于一个重复的作用了么
A：在没有`vue-router`的项目中，`Vue.js`框架主要是用以开发单页面应用，而我们在利用`vue-cli`脚手架工具创建的项目中，是引入了`vue-router`，则这个框架可以用来开发多页面应用，此时可以理解`App.vue`是这个应用（多页面）的根组件，多个页面可由`App.vue`控制，根据`App.vue`里的`<router-view>`进行渲染，然后我们自定义的这个父组件是单页面的根组件，用于单页面里的各个子组件的通信与管理，最后通过路由引入，就相当于自定义了多个应用内的页面了

### Q：怎么将 Vue 和 Laravel 框架的结合起来实现前后端分离
A：首先在前端的 Vue 框架里，需要安装一个[vue-axios](https://github.com/imcvampire/vue-axios)，这是根据`api`获取数据的vue插件。
使用方法：
* 先在项目中 ``` npm install --save axios vue-axios ```
* 其次在`main.js`中 写入
```javascript
import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(VueAxios, axios)v
```
* 最后在你要引入后端数据的组件中定义如下
```js
mounted() {
      this.axios.get('你的数据api的路径').then(response => {
        this.你的变量 = response.data
        console.log(response.data)
      }
    )
  },
```
这时候，我们分别启动执行`npm run dev`和`php artisan serve`来启动前后端两个框架的服务，会发现，我们在 Laravel 框架中定义返回的数据并没有在前端显示，并且打开 Chrome 的控制中心，，会发现报错，如图：
![](http://omqlv3air.bkt.clouddn.com/blog/2017-06-06-%E5%B1%8F%E5%B9%95%E5%BF%AB%E7%85%A7%202017-06-06%20%E4%B8%8A%E5%8D%889.20.30.png)
从这个报错字样会发现这是一个跨域访问的错误，解决这个，在后端的 Laravel 框架中，需要引入[laravel-cors](https://github.com/barryvdh/laravel-cors)，
使用方法：
* 现在在项目中执行`composer require barryvdh/laravel-cors`
* 然后在`config/app.php`文件中的`providers`数组添加`Barryvdh\Cors\ServiceProvider::class,`
* 最后在`app/Http/Kernel.php`文件中，`$middleware` 中，添加`\Barryvdh\Cors\HandleCors::class,`，已达到全局使用，当然也可以局部使用，在`github`上的文档有描述

现在再访问启动两个服务，就可以发现后端数据已经传到前端，从而实现了前后端开发分离
