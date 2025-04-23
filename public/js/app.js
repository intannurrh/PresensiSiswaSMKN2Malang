import '../../resources/js/bootstrap';

document.addEventListener("DOMContentLoaded", () => {
  const sign_in_btn = document.querySelector("#sign-in-btn");
  const sign_up_btn = document.querySelector("#sign-up-btn");
  const container = document.querySelector(".container");

  sign_up_btn?.addEventListener("click", () => {
    container.classList.add("sign-up-mode");
  });

  sign_in_btn?.addEventListener("click", () => {
    container.classList.remove("sign-up-mode");
  });

  document.querySelector(".sign-in-form")?.addEventListener("submit", function (e) {
    e.preventDefault();

    const role = document.getElementById("role")?.value;

    if (!role) {
      alert("Silakan pilih peran terlebih dahulu.");
      return;
    }

    switch (role) {
      case "guru":
        window.location.href = "/guru";
        break;
      case "siswa":
        window.location.href = "/siswa";
        break;
      case "ortu":
        window.location.href = "/ortu";
        break;
      default:
        alert("Peran tidak dikenali!");
    }
  });
});
