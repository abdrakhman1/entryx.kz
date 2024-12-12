$(function () {
    $("#sort").selectmenu();
});
// -----------------------------range filter секция каталог----------------------------

$(function () {
    function showRange(rangeMin, rangeMax) {
        $("#amount").html(
            `<div class="point-right">${rangeMin}</div><div class="point-left">${rangeMax}</div>`
        );
    }

    $("#slider-range").slider({
        range: true,
        min: 10000,
        max: 155000,
        step: 1000,
        values: [35000, 80000],
        slide: function (event, ui) {
            showRange(ui.values[0], ui.values[1]);
        },
    });

    const range = $("#slider-range");
    showRange(range.slider("values", 0), range.slider("values", 1));
});

// ----------------------------пагинация секция каталог-------------------------------

$("#light-pagination").pagination({
    items: 700,
    itemsOnPage: 20,
    displayedPages: 3,
    edges: 1,
    useEndEdge: true,
    prevText: "<",
    nextText: ">",
});

// -------------------------------------------------------

$(".filters_butn").on("click", function () {
    $("div.sort_mobile").toggleClass("no-show-mobile");
    $("div.overlay-black").toggleClass("no-show-mobile");
    $("div.overlay-black").toggleClass("overlay-show");
    $("body").css("overflow", "hidden");
});

$(".butn-exit").on("click", function () {
    $("div.sort_mobile").toggleClass("no-show-mobile");
    $("body").css("overflow", "auto");
    $("div.overlay-black").toggleClass("no-show-mobile");
    $("div.overlay-black").toggleClass("overlay-show");
});

// -------------------------------------------------------

$(".search_butn").on("click", function () {
    $(".search_window").addClass("show");
    $(".input-search").addClass("abs");
});
$(".butn_close-search").on("click", function () {
    $(".search_window.show").toggleClass("show");
    $(".input-search").removeClass("abs");
});

// ----------------------------

$(".select_open").on("click", function (e) {
    e.stopPropagation();
    $(".select_open").toggleClass("collapsed");
    $(".select_noshow").toggleClass("collapsed");
});

$("body").on("click", function () {
    if (!$(".select_open").next().hasClass("collapsed")) {
        $(".select_noshow").toggleClass("collapsed");
    }
});

// ----------------------------

const buttonElement = document.querySelector(".search_push");
const inputElement = document.querySelector('input[name="range-catalog"]');
const resultListElement = document.querySelector(".search_window ul");

function renderResult(data) {
    resultListElement.innerHTML = "";
    if (data.length === 0) {
        resultListElement.innerHTML = `<li class="no_border"><p> По запросу ничего не найдено </p></li>`;
        resultListElement.appendChild(noResultsItem);
    } else {
        data.forEach((result) => {
            const listItem = document.createElement("li");
            const image_path = result.image_path;
            listItem.innerHTML = `<a class="search_item_result" href="/product/${result.id}"> <img class="search_img" src="${image_path}"> ${result.title}</a>`;
            resultListElement.appendChild(listItem);
        });
    }
}

// Оборачиваем performSearch в асинхронную функцию
async function performSearch() {
    let inputValue = inputElement.value.trim(); // Введенный текст, убираем лишние пробелы

    if (inputValue) {
        try {
            const response = await fetch(`/product/search/${inputValue}`);
            if (response.ok) {
                const data = await response.json();
                renderResult(data); // Вызываем функцию для отрисовки результатов
            } else {
                console.error(
                    "Ошибка при выполнении запроса:",
                    response.status
                );
            }
        } catch (error) {
            console.error("Произошла ошибка:", error);
        }
    } else {
        // Если введенный текст пустой, очищаем список результатов
        renderResult([]);
    }
}

inputElement.addEventListener("keyup", async function (e) {
    if (e.key === "Enter") {
        await performSearch();
    }
});

buttonElement.addEventListener("click", async function (e) {
    e.preventDefault();
    await performSearch();
});
