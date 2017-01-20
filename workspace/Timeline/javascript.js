    function defilImgVrt(el,pas,tps,id) {
        if(typeof el=="string") { 
        el = document.getElementById(el); }
        var imgs = [];
        var offset = 0;
        var div_img = document.getElementById(id);
        //var bandeaux = document.getElementsByClassName("bandeau");
        //for(var i=0;i<bandeaux.length;i++) {
            var srcs = div_img.getElementsByTagName('img');
            var srcs_size=srcs.length;
            for(var i=0;i<srcs_size;i++) {
                var img = srcs[0];
                imgs.push(img);
                img.display="inline";
                img.style.height=el.offsetHeight+"px";
                img.style.position = "absolute";
                img.style.left = offset+"px";
                el.appendChild(img);
                offset += img.offsetWidth;
            }
            var first = 0;
            var last = imgs.length-1;
 
            (function d() {
                for(var i=0,l=imgs.length;i<l;i++) {
                    var top = parseInt(imgs[i].style.left,10);
                    imgs[i].style.left = (top-pas)+"px";
                    if(i==first && (top-pas+imgs[i].offsetWidth)<0) {
                        imgs[i].style.left = (parseInt(imgs[last].style.left,10)+imgs[last].offsetWidth-(i==0?pas:0))+"px";
                        last = first++;
                        if(first>imgs.length-1) { first = 0; }
                    }
                }
                setTimeout(d,tps);
            })();
        //}
    }