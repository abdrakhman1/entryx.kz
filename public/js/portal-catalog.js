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

// ----------------------------


// ----------------------------

$(".filters_butn").on("click", function () {
    $("div.overlay-black").css("display", "block");
    $("body").css("overflow", "hidden");
});

$(".butn-exit").on("click", function () {
    $("div.overlay-black").css("display", "none");
});
 
const overlayFilter = document.querySelector('.overlay-black');
const mediaQuery = window.matchMedia('(max-width: 992px)');

const handleMediaQuery = (event) => {
    overlayFilter.classList.toggle('desktop', !event.matches);
};
mediaQuery.addEventListener('change', handleMediaQuery);
handleMediaQuery(mediaQuery);
 
// ----------------------------

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

// --------------------------------------------

const buttonElementPortal = document.querySelector(".search_push");
const inputElementPortal = document.querySelector(
    'input[name="range-catalog"]'
);
const resultListElementPortal = document.querySelector(".search_window ul");

function renderResult(data) {
    resultListElementPortal.innerHTML = "";
    if (data.length === 0) {
        resultListElementPortal.innerHTML = `<li class="no_border"><p> По запросу ничего не найдено </p></li>`;
        resultListElementPortal.appendChild(noResultsItem);
    } else {
        data.forEach((result) => {
            const listItem = document.createElement("li");
            const image_path = result.image_path;
            listItem.innerHTML = `<a class="search_item_result" href="/portal/catalog/product/${result.id}"> <img class="search_img" src="${image_path}"> ${result.title}</a>`;
            resultListElementPortal.appendChild(listItem);
        });
    }
}

// Оборачиваем performSearch в асинхронную функцию
async function performSearch() {
    let inputValue = inputElementPortal.value.trim(); // Введенный текст, убираем лишние пробелы

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

inputElementPortal.addEventListener("keyup", async function (e) {
    if (e.key === "Enter") {
        await performSearch();
    }
});

buttonElementPortal.addEventListener("click", async function (e) {
    e.preventDefault();
    await performSearch();
});
