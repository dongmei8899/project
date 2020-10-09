define([],function(){
    function detail(){
        var oBefore=document.getElementById("before");
        var oGoal=document.getElementById("goal");
        var oAfter=document.getElementById("after");
        var oAfterImg=oAfter.getElementsByTagName("img")[0];
    
        oBefore.onmouseenter=function(){
            oGoal.style.display="block";
            oAfter.style.display="block";
        }
        oBefore.onmouseleave=function(){
            oGoal.style.display="none";
            oAfter.style.display="none";
        }
    
        oBefore.onmousemove=function(ev){
            var e=ev||window.event;
            var l=e.clientX-oBefore.offsetLeft-50;
    
            l=Math.max(0,l);
            l=Math.min(210,l);
            var t=e.clientY-oBefore.offsetTop-50;
            t=Math.max(0,t);
            t=Math.min(210,t);
            oGoal.style.left=l+"px";
            oGoal.style.top=t+"px";
    
            oAfterImg.style.left=-2*l+"px";
            oAfterImg.style.top=-2*t+"px";
        }
    }
    return{
        detail:detail
    }
})
