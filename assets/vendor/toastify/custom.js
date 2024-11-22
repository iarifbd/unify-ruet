var baseUrl = "<?php echo base_url(); ?>";
Toastify({
  text: "Welcome to Unify Admin",
  duration: 3000,
  close: true,
  avatar: baseUrl + 'assets/images/user3.png',
  className: "bg-success",
  offset: {
    x: 9,
    y: 57,
  },
}).showToast();