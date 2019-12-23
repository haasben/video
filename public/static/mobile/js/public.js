~function (designWidth) {
   let computed= function () {
		let desW=750;//设计稿宽度
		let devW=document.documentElement.clientWidth;//当前设备的宽度
		if(devW>=750){
			document.documentElement.style.fontSize="100px";
			return false;
		}else{
			document.documentElement.style.fontSize=devW/desW*100+"px";
		}
	}
	computed();
	window.addEventListener("resize",computed,false)
}();



