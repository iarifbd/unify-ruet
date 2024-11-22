// Get the base URL from the meta tag
var baseUrl = document.querySelector('meta[name="base_url"]').getAttribute('content');

// Use Toastify to show the toast notification
Toastify({
  text: "Welcome to Unify Admin",
  duration: 3000,
  close: true,
  avatar: baseUrl + 'assets/images/user3.png', // Concatenate the base URL with the image path
  className: "bg-success",
  offset: {
    x: 9,
    y: 57,
  },
}).showToast();
