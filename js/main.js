function uuidv4() {
  return "10000000-1000-4000-8000-100000000000".replace(/[018]/g, (c) =>
    (
      +c ^
      (crypto.getRandomValues(new Uint8Array(1))[0] & (15 >> (+c / 4)))
    ).toString(16)
  );
}
function validate_email($e) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test($e);
}
$(document).ready(function () {
  $("a").each(function () {
    if ($(this).prop("href") == window.location.href) {
      $(this).addClass("active");
    }
  });
});
