



document.addEventListener("DOMContentLoaded", () => {
    const categories = document.querySelectorAll(".category");
    const providers = document.querySelectorAll(".provider");

    categories.forEach((category) => {
        category.addEventListener("click", (event) => {
            event.preventDefault();

            const datasetCategory = category.dataset.category;

            providers.forEach((provider, index) => {
                const providersCategories = provider.dataset.category.split(" ");

                if (datasetCategory === "all" || providersCategories.includes(datasetCategory)) {
                    setTimeout(() => {
                        provider.style.display = "";
                    }, index * 100);
                } else {
                    provider.style.display = "none";
                }
            });
        });
    });
})