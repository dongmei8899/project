define(["startMove"],function(startMove){
function rebroadcast(){
    var oBanner=document.querySelector(".carousel");
    var oUl=document.querySelector(".carousel .imgBox");
    var oBtns=document.querySelectorAll(".carousel .point li");
    var LeftANDRightBtn=document.querySelectorAll(".leftRightTabs a");
    let iNow=1;
    let timer=null;
    let isRunning=false;

    timerInner();
    //点击圆点，图片转换
    for(var i=0;i<oBtns.length;i++){
        oBtns[i].index=i;
        oBtns[i].onclick=function(){
            iNow=this.index+1;
            shift();
        }
    }
    function timerInner(){
        timer=setInterval(function(){
            iNow++;
            shift();
        },2000)
    }
    function shift(){
        console.log(iNow);
        for(var i=0;i<oBtns.length;i++){
            oBtns[i].className="";
        }
        if(iNow==oBtns.length+1){
            oBtns[0].className="active";
        }else if(iNow==0){
            oBtns[oBtns.length-1].className="active";  
        }else{
            oBtns[iNow-1].className="active";
        }
        isRunning=true;
        startMove.startMove(oUl,{left:iNow*-823},function(){
            if(iNow==oBtns.length+1){
                iNow=1;
                oUl.style.left="-823px";

            }else if(iNow==0){
                iNow=3;
                oUl.style.left=iNow*-823+"px";
            }
            isRunning=false;
        })
    }
    oBanner.onmouseenter=function(){
        clearInterval(timer);
    }
    oBanner.onmouseleave=function(){
        timerInner();
    }
    LeftANDRightBtn[0].onclick=function(){
        if(!isRunning){
            iNow--;
            shift();
        }
        return false;
    }
    LeftANDRightBtn[1].onclick=function(){
        if(!isRunning){
            iNow++;
            shift();
        }
        return false;
    }
}
return{
    rebroadcast:rebroadcast
}
})