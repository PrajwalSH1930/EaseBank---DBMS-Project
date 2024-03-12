const logOutBtn = document.getElementById("log_out"),
  logOutModel = document.querySelector(".log-out--model"),
  logOut = document.querySelector(".logout-btn"),
  deleteAccount = document.querySelector(".confirm-btn"),
  transferModel = document.querySelector(".transfer_model"),
  transferPinModel = document.querySelector(".form__btn--pin-model"),
  logOutAcc = document.querySelector(".log_out--acc"),
  mainOverlay = document.querySelector(".overlay-main"),
  btnOk = document.querySelectorAll(".btn-ok"),
  transferMsg = document.querySelector(".transfer-msg");

btnOk.forEach(function (btn) {
  btn.addEventListener("click", function (e) {
    e.preventDefault();
    logOutModel.classList.remove("active");
    mainOverlay.classList.add("hidden");
  });
});
logOutAcc.addEventListener("click", function (e) {
  e.preventDefault();
  mainOverlay.classList.remove("hidden");
  logOutModel.classList.add("active");
});
