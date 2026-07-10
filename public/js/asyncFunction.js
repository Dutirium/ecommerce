console.log("asyncFunction is loading");

window.addEventListener("pageshow", function (event) {
    if (event.persisted) {
        window.location.reload();
    }
});
// ======================================================
// CSRF TOKEN
// ======================================================

const csrfToken = document
    .querySelector('meta[name="csrf-token"]')
    ?.getAttribute('content');


// ======================================================
// WISHLIST AJAX
// ======================================================

const wishlistBtns = document.querySelectorAll(".wishlistBtn");

wishlistBtns.forEach((button) => {

    button.addEventListener("click", async function () {

        const productId = button.dataset.productId;

        try {

            const response = await fetch("/wishlist", {

                method: "POST",

                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                },

                body: JSON.stringify({
                    productId: productId,
                }),
            });


            const data = await response.json();


            if (!response.ok) {

                console.error(
                    "Wishlist request failed:",
                    data
                );

                return;
            }


            // Product added to wishlist
            if (data.status === "added") {

                button.textContent =
                    "Remove from Wishlist";

                return;
            }


            // Product removed from wishlist
            if (data.status === "removed") {

                const wishlistPage = button.closest(
                    '[data-page="wishlist"]'
                );


                // We are currently on the wishlist page
                if (wishlistPage) {

                    const wishlistItem = button.closest(
                        ".wishlistItem"
                    );


                    if (wishlistItem) {
                        wishlistItem.remove();
                    }


                    const remainingItems =
                        wishlistPage.querySelectorAll(
                            ".wishlistItem"
                        );


                    if (remainingItems.length === 0) {

                        wishlistPage.hidden = true;


                        const emptyMessage =
                            document.getElementById(
                                "emptyWishlistMessage"
                            );


                        if (emptyMessage) {
                            emptyMessage.hidden = false;
                        }
                    }

                }

                // We are on list page or product page
                else {

                    button.textContent =
                        "Add to Wishlist";
                }
            }

        } catch (error) {

            console.error(
                "Wishlist request failed:",
                error
            );
        }
    });
});



// ======================================================
// CART AJAX REQUEST FUNCTION
// ======================================================

async function updateCart(url, method, cartItem) {

    try {

        const response = await fetch(url, {

            method: method,

            headers: {
                "Accept": "application/json",
                "X-CSRF-TOKEN": csrfToken,
                "X-Requested-With": "XMLHttpRequest",
            },
        });


        const data = await response.json();


        if (!response.ok) {

            alert(
                data.message ||
                "Something went wrong."
            );

            return;
        }


        // Update cart total
        const cartTotalValue =
            document.querySelector(
                "#cartTotalValue"
            );


        if (cartTotalValue) {

            cartTotalValue.textContent =
                data.cartTotal;
        }


        // Quantity changed
        if (data.status === "updated") {

            const quantityElement =
                cartItem.querySelector(
                    ".cartQuantity"
                );


            const subtotalElement =
                cartItem.querySelector(
                    ".itemSubtotal"
                );


            if (quantityElement) {

                quantityElement.textContent =
                    data.quantity;
            }


            if (subtotalElement) {

                subtotalElement.textContent =
                    data.subtotal;
            }
        }


        // Item removed
        if (data.status === "removed") {

            cartItem.remove();

            checkEmptyCart();
        }

    } catch (error) {

        console.error(
            "Cart request failed:",
            error
        );
    }
}



// ======================================================
// CHECK EMPTY CART
// ======================================================

function checkEmptyCart() {

    const cartItems =
        document.querySelectorAll(
            ".cartItem"
        );


    const cartContainer =
        document.querySelector(
            '[data-page="cart"]'
        );


    const emptyCartMessage =
        document.querySelector(
            ".emptyCartMessage"
        );


    if (cartItems.length === 0) {

        if (cartContainer) {
            cartContainer.hidden = true;
        }


        if (emptyCartMessage) {
            emptyCartMessage.hidden = false;
        }
    }
}



// ======================================================
// INCREASE CART QUANTITY
// ======================================================

document
    .querySelectorAll(".increaseCartBtn")
    .forEach((button) => {

        button.addEventListener(
            "click",
            function () {

                const cartItemId =
                    button.dataset.cartItemId;


                const cartItem =
                    button.closest(
                        ".cartItem"
                    );


                if (!cartItem) {
                    return;
                }


                updateCart(
                    `/cart/${cartItemId}/increase`,
                    "PATCH",
                    cartItem
                );
            }
        );
    });



// ======================================================
// DECREASE CART QUANTITY
// ======================================================

document
    .querySelectorAll(".decreaseCartBtn")
    .forEach((button) => {

        button.addEventListener(
            "click",
            function () {

                const cartItemId =
                    button.dataset.cartItemId;


                const cartItem =
                    button.closest(
                        ".cartItem"
                    );


                if (!cartItem) {
                    return;
                }


                updateCart(
                    `/cart/${cartItemId}/decrease`,
                    "PATCH",
                    cartItem
                );
            }
        );
    });



// ======================================================
// REMOVE CART ITEM
// ======================================================

document
    .querySelectorAll(".removeCartBtn")
    .forEach((button) => {

        button.addEventListener(
            "click",
            function () {

                const cartItemId =
                    button.dataset.cartItemId;


                const cartItem =
                    button.closest(
                        ".cartItem"
                    );


                if (!cartItem) {
                    return;
                }


                updateCart(
                    `/cart/${cartItemId}`,
                    "DELETE",
                    cartItem
                );
            }
        );
    });

    const addToCartForms =
    document.querySelectorAll(".addToCartForm");

addToCartForms.forEach((form) => {

    form.addEventListener("submit", async (event) => {

        event.preventDefault();

        const button =
            form.querySelector('button[type="submit"]');

        const formData =
            new FormData(form);

        const originalText =
            button.textContent;

        button.disabled = true;
        button.textContent = "Adding...";

        try {

            const response = await fetch(form.action, {
                method: "POST",

                headers: {
                    "Accept": "application/json",
                },

                body: formData,
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(
                    data.message ||
                    "Could not add product to cart."
                );
            }

            button.textContent = "Added to Cart";

            setTimeout(() => {
                button.textContent = originalText;
                button.disabled = false;
            }, 2000);

        } catch (error) {

            button.textContent = error.message;

            setTimeout(() => {
                button.textContent = originalText;
                button.disabled = false;
            }, 2500);
        }
    });
});