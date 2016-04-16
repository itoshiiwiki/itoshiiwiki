function getRandomSize(minium, maxium){
    return Math.floor(Math.random() * maxium) + minium;
}

function getRandomColor(){
    return "rgb(" + getRandomSize(0, 255) + ", " + getRandomSize(0, 255) + ", " + getRandomSize(0, 255) + ")";
}

function fixCameraPosition(){
    lve("camera_bg").animate({
        left: lveCanvas.width / 2,
        bottom: lveCanvas.height / 2
    }, turmDelay, "easeInOutQuad");
}

function lveInit(){
    lveSuccess = lve.init({
        canvas: document.getElementById("myCanvas"),
        frameLimit: 60
    }),
    lveCanvas = lve_root.vars.initSetting.canvas;
    
    // 설정되지 못했을 시
    if (!lveSuccess){
       return !1;
    }
    
    // 메인 카메라 생성
    lve("camera_bg").create({
        type: "camera",
        scene: "bg"
    }).css({
        left: lveCanvas.width / 2,
        bottom: lveCanvas.height / 2
    }).use();
    
    
    var maxiumParticle = 30;
    
    for (var i = 0; i < maxiumParticle; i++){
        var randomSize = getRandomSize(5, 15);
            
        lve("particle_circle").create({
            type: "circle",
            scene: "bg"
        }).css({
            width: randomSize,
            height: randomSize,
            color: getRandomColor(),
            left: getRandomSize(0, lveCanvas.width),
            bottom: getRandomSize(0, lveCanvas.height)
        }).animate({
            left: getRandomSize(0, lveCanvas.width),
            bottom: getRandomSize(0, lveCanvas.height),
            perspective: getRandomSize(150, 200)
        }, turmDelay, "easeInOutQuad");
    }
    
    lve("particle_circle").on("animateend", function(e){
        lve(e.target).animate({
            left: getRandomSize(0, lveCanvas.width),
            bottom: getRandomSize(0, lveCanvas.height),
            perspective: getRandomSize(150, 200) 
        }, turmDelay, "easeInOutQuad");
        
        fixCameraPosition();
    });
    
    
    // 캔버스 opacity 조절
    $("#myCanvas").css({
        opacity: 0
    }).animate({
        opacity: .1
    }, 1000);
}


var lveSuccess, lveCanvas,
    turmDelay = 10000;

$(window).on("resize load", function(){
    var widthNum = $(window).width(),
        heightNum = $(window).height();
        
    $("#myCanvas").attr({
        width: widthNum,
        height: heightNum
    });
    
    // myCanvas width, height 속성 변경
    if (lveSuccess)
        lve.canvasResize();
});

$(window).on("load", function(){
    // myCanvas width, height 속성 변경
    // 캔버스 설정
    //lveInit();
    //lve.canvasResize();
});


/* 문서 동적 수정
 * 만들어진 객체를 다시 고침
 */
 
function setWikiTocReposition(){
    var $elem_toc = $(".wikiToc"),
        isExists = !!$elem_toc.length;
    
    if (!isExists)
        return !1;
        
    var newElem_wrap = document.createElement("div");
        newElem_origin = $elem_toc.clone(!0); // deep copy
        
    $(newElem_wrap).addClass("wikiToc_wrap").append(newElem_origin);
    $elem_toc.replaceWith(newElem_wrap);
}

function setWikiFootDelete(){
    $(".foot tt.wiki").replaceWith("<hr>");
}

function setNoticeWarnEditable(){
    var isEditpage = location.href.indexOf("action=edit") != -1;
    
    if (!isEditpage)
        return !1;
        
    var text_warn = $("#wiki-message .warn").text();
    var isEditable = text_warn.indexOf("You are not allowed to edit this page") == -1;
    
    if (!isEditable)
        Alert("위키니트 " + wikiManager + "이 말합니다", message_edit_unable);
}


$(document).ready(function(){
    setWikiTocReposition(); // 목차 위치 우측으로 이동
    setWikiFootDelete(); // 각주 수평선 오류 (----) 수정
    setNoticeWarnEditable(); // 수정 불가 안내 메세지
});