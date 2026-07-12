const checkoutForm = document.querySelector("#checkoutForm");
const checkoutButton = document.querySelector("#checkoutButton");

const loadingOverlay = document.querySelector(
    "#checkoutLoadingOverlay"
);

const loadingText = document.querySelector(
    "#checkoutLoadingText"
);


if (checkoutForm && checkoutButton) {

    checkoutForm.addEventListener(
        "submit",
        async (event) => {

            const paymentMethod = document.querySelector(
                'input[name="payment_method"]:checked'
            )?.value;


            /*
            |--------------------------------------------------------------------------
            | COD Checkout
            |--------------------------------------------------------------------------
            */

            if (paymentMethod === "cod") {

                checkoutButton.disabled = true;


                if (loadingText) {
                    loadingText.textContent =
                        "Placing your order...";
                }


                if (loadingOverlay) {
                    loadingOverlay.classList.add(
                        "active"
                    );
                }


                /*
                | Do not call preventDefault().
                | The normal COD form submission continues.
                */

                return;
            }


            /*
            |--------------------------------------------------------------------------
            | Razorpay Checkout
            |--------------------------------------------------------------------------
            */

            if (paymentMethod !== "razorpay") {
                return;
            }


            event.preventDefault();

            checkoutButton.disabled = true;


            try {

                const csrfToken = document
                    .querySelector(
                        'meta[name="csrf-token"]'
                    )
                    ?.getAttribute("content");


                /*
                |--------------------------------------------------------------------------
                | Collect Checkout Form Data
                |--------------------------------------------------------------------------
                */

                const formData =
                    new FormData(checkoutForm);


                /*
                |--------------------------------------------------------------------------
                | Create Razorpay Order
                |--------------------------------------------------------------------------
                */

                const orderResponse = await fetch(
                    "/checkout/razorpay/order",
                    {
                        method: "POST",

                        headers: {
                            "X-CSRF-TOKEN":
                                csrfToken,

                            "Accept":
                                "application/json",
                        },

                        body: formData,
                    }
                );


                const orderData =
                    await orderResponse.json();


                if (!orderResponse.ok) {

                    throw new Error(
                        orderData.message ||
                        "Could not start payment."
                    );
                }


                /*
                |--------------------------------------------------------------------------
                | Razorpay Checkout Configuration
                |--------------------------------------------------------------------------
                */

                const options = {

                    key:
                        orderData.key,

                    amount:
                        orderData.amount,

                    currency:
                        orderData.currency,

                    order_id:
                        orderData.razorpay_order_id,

                    name:
                        "Test Store",

                    description:
                        "Order Payment",


                    /*
                    |--------------------------------------------------------------------------
                    | Payment Success Handler
                    |--------------------------------------------------------------------------
                    */

                    handler: async function (
                        paymentResponse
                    ) {

                        /*
                        |--------------------------------------------------------------------------
                        | Show Finalization Loader
                        |--------------------------------------------------------------------------
                        */

                        if (loadingText) {
                            loadingText.textContent =
                                "Confirming payment and creating your order...";
                        }


                        if (loadingOverlay) {
                            loadingOverlay.classList.add(
                                "active"
                            );
                        }


                        try {

                            /*
                            |--------------------------------------------------------------------------
                            | Verify Payment and Finalize Order
                            |--------------------------------------------------------------------------
                            */

                            const verifyResponse =
                                await fetch(
                                    "/checkout/razorpay/verify",
                                    {
                                        method:
                                            "POST",

                                        headers: {
                                            "Content-Type":
                                                "application/json",

                                            "Accept":
                                                "application/json",

                                            "X-CSRF-TOKEN":
                                                csrfToken,
                                        },

                                        body:
                                            JSON.stringify({

                                                razorpay_payment_id:
                                                    paymentResponse
                                                        .razorpay_payment_id,

                                                razorpay_order_id:
                                                    paymentResponse
                                                        .razorpay_order_id,

                                                razorpay_signature:
                                                    paymentResponse
                                                        .razorpay_signature,
                                            }),
                                    }
                                );


                            const result =
                                await verifyResponse.json();


                            if (!verifyResponse.ok) {

                                throw new Error(
                                    result.message ||
                                    "Payment verification failed."
                                );
                            }


                            /*
                            |--------------------------------------------------------------------------
                            | Redirect to Existing Success Page
                            |--------------------------------------------------------------------------
                            */

                            window.location.href =
                                result.redirect_url;


                        } catch (error) {

                            console.error(
                                "Payment finalization error:",
                                error
                            );


                            if (loadingOverlay) {
                                loadingOverlay.classList.remove(
                                    "active"
                                );
                            }


                            checkoutButton.disabled =
                                false;


                            alert(
                                "Payment was completed, but order confirmation failed. Please contact support."
                            );
                        }
                    },


                    /*
                    |--------------------------------------------------------------------------
                    | Payment Modal Closed
                    |--------------------------------------------------------------------------
                    */

                    modal: {

                        ondismiss: function () {

                            checkoutButton.disabled =
                                false;
                        },
                    },
                };


                /*
                |--------------------------------------------------------------------------
                | Open Razorpay Checkout
                |--------------------------------------------------------------------------
                */

                const razorpay =
                    new Razorpay(options);


                /*
                |--------------------------------------------------------------------------
                | Payment Failure Handler
                |--------------------------------------------------------------------------
                */

                razorpay.on(
                    "payment.failed",
                    function (response) {

                        console.error(
                            "Payment failed:",
                            response.error
                        );


                        checkoutButton.disabled =
                            false;


                        alert(
                            response.error.description ||
                            "Payment failed. Please try again."
                        );
                    }
                );


                razorpay.open();


            } catch (error) {

                console.error(
                    "Checkout error:",
                    error
                );


                checkoutButton.disabled =
                    false;


                if (loadingOverlay) {
                    loadingOverlay.classList.remove(
                        "active"
                    );
                }


                alert(
                    error.message ||
                    "Could not start payment."
                );
            }
        }
    );
}

/*
|--------------------------------------------------------------------------
| Coupon Code
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Coupon Code
|--------------------------------------------------------------------------
*/

const applyButton = document.getElementById("applyCoupon");

if (applyButton) {

    applyButton.addEventListener("click", async () => {

        const couponCode = document
            .getElementById("coupon_code")
            .value
            .trim();

        if (!couponCode) {

            document.getElementById("couponMessage").textContent =
                "Please enter a coupon code.";

            return;
        }

        const couponUrl = document
            .getElementById("couponConfig")
            .dataset.couponUrl;

        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .content;

        try {

            const response = await fetch(couponUrl, {

                method: "POST",

                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                },

                body: JSON.stringify({
                    coupon_code: couponCode,
                }),
            });

            const data = await response.json();

            if (!data.success) {

                document.getElementById(
                    "couponMessage"
                ).textContent = data.message;

                return;
            }

            document.getElementById(
                "couponMessage"
            ).textContent = data.message;

            document.getElementById(
                "subtotalAmount"
            ).textContent =
                "₹" + Number(data.subtotal).toFixed(2);

            document.getElementById(
                "discountAmount"
            ).textContent =
                "- ₹" + Number(data.discount).toFixed(2);

            document.getElementById(
                "gstAmount"
            ).textContent =
                "₹" + Number(data.gst).toFixed(2);

            document.getElementById(
                "shippingAmount"
            ).textContent =
                "₹" + Number(data.shipping).toFixed(2);

            document.getElementById(
                "totalAmount"
            ).textContent =
                "₹" + Number(data.total).toFixed(2);

        } catch (error) {

            console.error(error);

            document.getElementById(
                "couponMessage"
            ).textContent =
                "Unable to apply coupon.";
        }

    });

}