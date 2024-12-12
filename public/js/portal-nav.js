// --------------------------мобильное меню--------------------

$(".burger").on("click", function () {
    $(".portal_menu").css("right", "0");
    $(".overlay").show();
    $(".exit").find("img").attr("src", "/img/icon/logout-red.svg");
});


// --------------------------кнопка назад-------------------------

$(".go_back").on("click", function () {
    window.history.back();
});

// --------------------------уведомления-------------------------

$(".notice_call").on("click", function () {
    $("body").toggleClass("body_overlay");
    $(".notice_field").toggleClass("notice_field-show");
    $(".overlay").show();
});

$(".overlay").on("click", function () {
    if ($(".notice_field").hasClass("notice_field-show")) {
        $(".notice_field").toggleClass("notice_field-show");
    } else {
        $(".portal_menu").css("right", "-500px");
        $(".overlay").hide();
        $(".exit").find("img").attr("src", "/img/logout.svg");
    }
    $("body").toggleClass("body_overlay");
    $(".overlay").hide();
});
 

const noticeHeader = document.querySelector(".notice_call .notice_elem");
const noticeField = document.querySelector(".notice_items");
document.querySelectorAll(".notice_exit").forEach((noticeExit) => {
    noticeExit.addEventListener("click", async (e) => {
        e.preventDefault();
        const target = e.target;
        const url = target.getAttribute("href");
        const resp = await fetch(url);
        const data = await resp.json();
        noticeHeader.innerText = data.unreaded_count;
        data.unreaded_count ? $(noticeHeader).show() : $(noticeHeader).hide();
        document
            .querySelectorAll(`.notice_exit[href="${url}"]`)
            .forEach((noticeExit) => {
                const notifiesItem = noticeExit.closest(".notifies_item");
                const noticeItem = noticeExit.closest(".notice_item");
                if (notifiesItem) {
                    notifiesItem?.classList?.remove?.("not-read");
                    $(noticeExit).hide();
                }
                if (noticeItem) {
                    $(noticeItem).hide();
                }
            });

        if (!data.unreaded_count) {
            noticeField.innerText = "Уведомлений нет";
        }
    });
});
