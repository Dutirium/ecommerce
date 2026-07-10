  document.addEventListener("DOMContentLoaded", () => {

        const mainProductImage =
            document.querySelector("#mainProductImage");

        const thumbnailButtons =
            document.querySelectorAll(".thumbnailBtn");

        if (!mainProductImage) {
            return;
        }

        thumbnailButtons.forEach((button) => {

            button.addEventListener("click", () => {

                mainProductImage.src =
                    button.dataset.imageUrl;

                thumbnailButtons.forEach((thumbnail) => {
                    thumbnail.classList.remove("active");
                });

                button.classList.add("active");
            });

        });

    });


        (function() {
        const toast = document.getElementById('toast');
        if (toast) {
            // Wait 2.5 seconds, then add the fade-out class
            setTimeout(() => {
                toast.classList.add('fade-out');
                // Completely remove it from the DOM after the transition finishes
                setTimeout(() => {
                    toast.remove();
                }, 400);
            }, 2500);
        }
    })();