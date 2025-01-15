// script.js

// Fetch all listings from the page
const listingsContainer = document.getElementById("listings");
const filterGender = document.getElementById("filter-gender");
const filterSuburb = document.getElementById("filter-suburb");
const sortPrice = document.getElementById("sort-price");

// Helper function to extract listings from the DOM
function extractListings() {
  const listings = [];
  const cards = listingsContainer.querySelectorAll(".card");

  cards.forEach((card) => {
    const title = card.querySelector(".card-title").textContent;
    const description = card.querySelector(".card-description").textContent;
    const price = parseFloat(
      card.querySelector("p:last-of-type").textContent.replace("Price: $", "")
    );
    const gender = card.dataset.gender;
    const suburb = card.dataset.suburb;

    listings.push({
      element: card,
      title,
      description,
      price,
      gender,
      suburb,
    });
  });

  return listings;
}

// Render filtered and sorted listings
function renderListings(listings) {
  listingsContainer.innerHTML = ""; // Clear current listings
  listings.forEach((listing) => {
    listingsContainer.appendChild(listing.element); // Append filtered/sorted elements
  });
}

// Filter and sort listings based on user input
function applyFiltersAndSorting() {
  let listings = extractListings();

  // Apply gender filter
  const selectedGender = filterGender.value;
  if (selectedGender) {
    listings = listings.filter((listing) => listing.gender === selectedGender);
  }

  // Apply suburb filter
  const selectedSuburb = filterSuburb.value;
  if (selectedSuburb) {
    listings = listings.filter((listing) => listing.suburb === selectedSuburb);
  }

  // Apply price sorting
  const selectedSort = sortPrice.value;
  if (selectedSort === "asc") {
    listings.sort((a, b) => a.price - b.price);
  } else if (selectedSort === "desc") {
    listings.sort((a, b) => b.price - a.price);
  }

  // Render the updated listings
  renderListings(listings);
}

// Event listeners for filters and sorting
filterGender.addEventListener("change", applyFiltersAndSorting);
filterSuburb.addEventListener("change", applyFiltersAndSorting);
sortPrice.addEventListener("change", applyFiltersAndSorting);

// Expand full description when "Show More" is clicked
listingsContainer.addEventListener("click", (event) => {
  if (event.target.classList.contains("show-more")) {
    const descriptionElem = event.target.previousElementSibling;
    const fullDescription = event.target.dataset.fullDescription;

    descriptionElem.textContent = fullDescription;
    event.target.style.display = "none"; // Hide the "Show More" button
  }
});
