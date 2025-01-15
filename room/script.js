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
    const gender = card.getAttribute("data-gender");
    const suburb = card.getAttribute("data-suburb");

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

// Add event listeners for all "Call Now" buttons
document.querySelectorAll(".call-now-btn").forEach((button) => {
  button.addEventListener("click", (event) => {
    const mobile = button.getAttribute("data-mobile");
    alert(`Host's Phone Number: ${mobile}`);
  });
});

// Initialize the image slider for each card (if using a library)
document.querySelectorAll(".image-slider").forEach((slider) => {
  // Initialize slider here (e.g., Swiper.js or custom)
});
