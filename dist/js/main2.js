require.config({
    paths: {
      jquery: "jquery-1.11.3",
      "jquery-cookie": "jquery.cookie",
    //   startMove: "startMove",
      goods:"goods"
    },
    //jquery-cookie 依赖于jquery
    shim: {
      //设置依赖关系
      "jquery-cookie": ["jquery"],
      //某一个模块，不遵从AMD
      parabola: {
        exports: "_",
      }
    }
  })
  
  
  //调用首页的代码
  require(["goods"], function(goods){
    // index.body();
    goods.goods();
  })
  