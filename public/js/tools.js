function showTabs(content) {
    for (i = 0; i < 4; i++) {
        document.getElementsByClassName("tabContent")[i].style.display = "none";
    }
    document.getElementById(content).style.display = "block";
    
}

/* Google button */
function onSuccess(googleUser) {
    console.log('Logged in as: ' + googleUser.getBasicProfile().getName());
  }
  function onFailure(error) {
    console.log(error);
  }
  function renderButton() {
    gapi.signin2.render('my-signin2', {
      'scope': 'profile email',
      'width': 240,
      'height': 50,
      'longtitle': true,
      'theme': 'dark',
      'onsuccess': onSuccess,
      'onfailure': onFailure
    });
  }

/* Show Sidebar */
$(document).ready(function () {


    if ($(window).width() < 790) {
        $('.nav-sidebar').css('position', 'fixed');
    }

    if ($(window).width() > 790) {
        $('.nav-sidebar').css('position', 'sticky');
        if ($('.nav-sidebar').hasClass("show")) {
            $(".screen-overlay").removeClass("show");
            $(".nav-sidebar").removeClass("show");
            if ($("i").hasClass("fa-long-arrow-alt-right")) {

                $("#open").remove();
                $(".side-button").append("<i class='fas fa-long-arrow-alt-left' id='close'></i>");
            } else if ($("i").hasClass("fa-long-arrow-alt-left")) {

                $("#close").remove();
                $(".side-button").append("<i class='fas fa-long-arrow-alt-right' id='open'></i>");
            }
        }
    }

    $(window).resize(function () {
        if ($(window).width() > 790) {
            $('.nav-sidebar').css('position', 'sticky');
            if ($('.nav-sidebar').hasClass("show")) {
                $(".screen-overlay").removeClass("show");
                $(".nav-sidebar").removeClass("show");
                if ($("i").hasClass("fa-long-arrow-alt-right")) {

                    $("#open").remove();
                    $(".side-button").append("<i class='fas fa-long-arrow-alt-left' id='close'></i>");
                } else if ($("i").hasClass("fa-long-arrow-alt-left")) {

                    $("#close").remove();
                    $(".side-button").append("<i class='fas fa-long-arrow-alt-right' id='open'></i>");
                }
            }
        }

        if ($(window).width() < 790) {
            $('.nav-sidebar').css('position', 'fixed');
        }

        
    });

    $(".side-button").on("click", function (e) {

        $('.nav-sidebar').css('position', 'fixed');
        $('#close').css('display', 'block');
        if ($("i").hasClass("fa-long-arrow-alt-right")) {
            $("#open").remove();
            $(".side-button").append("<i class='fas fa-long-arrow-alt-left' id='close'></i>");
            $(".side-button").css('margin-left', '110px');
        } else if ($("i").hasClass("fa-long-arrow-alt-left")) {
            $("#close").remove();
            $(".side-button").append("<i class='fas fa-long-arrow-alt-right' id='open'></i>");
            $(".side-button").css('margin-left', '0px');
        }

        e.preventDefault();
        e.stopPropagation();
        var offcanvas_id = $(this).attr('data-trigger');
        $(offcanvas_id).toggleClass("show");
        $(".screen-overlay").toggleClass("show");

    });

    // Close menu when pressing ESC
    $(document).on('keydown', function (event) {
        if (event.keyCode === 27) {
            $(".nav-sidebar").removeClass("show");
            $(".screen-overlay").removeClass("show");
            $("body").removeClass("overlay-active");

            $("#close").remove();
            $("#open").remove();
            $(".side-button").append("<i class='fas fa-long-arrow-alt-right' id='open'></i>");
            $(".side-button").css('margin-left', '0px');

        }
    });

    $(".screen-overlay").click(function (e) {

        $(".nav-sidebar").removeClass("show");
        $(".screen-overlay").removeClass("show");
        $("body").removeClass("overlay-active");

        $("#close").remove();
        $("#open").remove();
        $(".side-button").append("<i class='fas fa-long-arrow-alt-right' id='open'></i>");
        $(".side-button").css('margin-left', '0px');

    });
});



function createTag(id) {
    var value = document.getElementById(id).id;
    var newValue = value.substring(14);

    var tag = document.createElement('div');
    tag.setAttribute('class', 'tag');
    tag.setAttribute('id', newValue);

    var tagIcon = document.createElement('i');
    tagIcon.setAttribute('class', 'fas fa-tag');

    var tagName = document.createElement('div');
    tagName.innerHTML = newValue;

    var closeIcon = document.createElement('i');
    closeIcon.setAttribute('class', 'fa fa-close');

    tag.appendChild(tagIcon);
    tag.appendChild(tagName);
    tag.appendChild(closeIcon);

    return tag;
}

function checkbox(id) {
    var checkBox = document.getElementById(id);
    var value = document.getElementById(id).id;
    var newValue = value.substring(14);
    var container = document.getElementById("tag-container");
    var input = createTag(id);
    if (checkBox.checked == true) {
        console.log(id+'check');
        console.log(container.appendChild(input));
        container.appendChild(input);
    } else if (checkBox.checked == false) {
        console.log(id+'uncheck')
        var tag = document.getElementById(newValue);
        console.log(tag.parentNode.removeChild(tag));
        tag.parentNode.removeChild(tag);
    }

}

// function votePost(post){
//     var iconType = post.search("-up");

//     var iconClicked = document.getElementById(post);
//     var clickedValue = iconClicked.getAttribute("value");
//     var clickedVoteCount = parseInt(iconClicked.innerHTML);

//     if(iconType>0){
//         var iconNotClicked = document.getElementById(post.replace("-up", "-down"));
//     }else{
//         var iconNotClicked = document.getElementById(post.replace("-down", "-up"))
//     }

//     var notClickedValue = iconNotClicked.getAttribute("value");
//     var notClickedVoteCount = parseInt(iconNotClicked.innerHTML);

//     if(clickedValue=="0" && notClickedValue=="0"){
//         iconClicked.style.color = "#3f51b5";
//         iconClicked.setAttribute("value","1");

//         iconClicked.innerHTML = " "+ (clickedVoteCount+1);

//         console.log(iconClicked.getAttribute("value"))
//     }
//     else if(clickedValue=="1" && notClickedValue=="0"){
//         iconClicked.style.color = "";
//         iconClicked.setAttribute("value","0");

//         iconClicked.innerHTML = " "+ (clickedVoteCount-1);

//         console.log(iconClicked.getAttribute("value"))
//     }
//     else if(clickedValue=="0" && notClickedValue == "1"){
//         iconClicked.style.color = "#3f51b5";
//         iconClicked.setAttribute("value","1");

//         iconClicked.innerHTML = " "+ (clickedVoteCount+1);

//         iconNotClicked.style.color = "";
//         iconNotClicked.setAttribute("value","0");

//         iconNotClicked.innerHTML = " "+ (notClickedVoteCount-1);
//     }

// }

function setRating(id){
    var star = document.getElementsByClassName("star");
    var new_rating = id.replace("star", "");
    var old_rating = document.getElementById("userrating").value;

    for(i=0; i<star.length; i++){
        star[i].style.color = "gray";
    }

    if(new_rating!=old_rating){
        for(i=0; i<new_rating; i++){
            star[i].style.color = "#3f51b5";
        }
    }else{
        new_rating = 0;
    }

    document.getElementById("userrating").setAttribute("value", new_rating);

    console.log(document.getElementById("userrating").value);
}

function ageSlider(){
    const
  range = document.getElementById('range'),
  rangeV = document.getElementById('rangeV'),
  setValue = ()=>{
    const
      newValue = Number( (range.value - range.min) * 100 / (range.max - range.min) ),
      newPosition = 10 - (newValue * 0.2);
    rangeV.innerHTML = `<span>${range.value}</span>`;
    rangeV.style.left = `calc(${newValue}% + (${newPosition}px))`;
  };
document.addEventListener("DOMContentLoaded", setValue);
range.addEventListener('input', setValue);
}

/*function editImageModal(buttonId){
    var imageChanged = document.getElementById(buttonId).getAttribute("value");
    var title = document.getElementById("editImageModalTitle");
    var file = document.getElementById("imageFile");
    var formType = document.getElementById("formType");
    //var form = document.getElementById("editImageForm");
    formType.value = imageChanged;
    title.innerHTML = "Select image for " + imageChanged;
    file.name = imageChanged + "edit";
    //if(imageChanged == "banner" || imageChanged == "logo"){
    //    form.action = "{{route('editgamepageimage')}}"
    //} else{
    //    form.action = "{{route('editavatar')}}"
    //}
    //console.log(form);
}*/


// jQuery

$(document).on("dblclick", "#jquerytest", function(){

    var current = $(this).text();
    $("#jquerytest").html('<textarea class="form-control" id="newcont" rows="5">'+current+'</textarea>');
    $("#newcont").focus();
    
    $("#newcont").focus(function() {
        console.log('in');
    }).blur(function() {
         var newcont = $("#newcont").val();
         $("#jquerytest").text(newcont);
    });

})

// $('.lowlayer').on('show.bs.modal', function (event) {
//     setTimeout(function() {
//         $('.modal-backdrop').css('z-index', 1040).addClass('modal-lowest');
//         console.log($('.modal-lowest').css('z-index'));
//     }, 0);
// });

// $('.multilayer').on('show.bs.modal', function (event) {
//     $(this).css('z-index', 1100);
//     setTimeout(function() {
//         $('.modal-backdrop').css('z-index', 1049).addClass('modal-multi');
//         console.log($('.modal-multi').css('z-index'));
//     }, 0);
// });

