// text-price-format

const text_price = document.querySelectorAll(".text-price-format");

text_price.forEach(price => {
    price.innerHTML = price.textContent.replace('.', ',');
});