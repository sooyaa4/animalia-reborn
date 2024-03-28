"use strict";
var KTSigninGeneral = (function () {
    var t, e, r;
    return {
        init: function () {
            (t = document.querySelector("#kt_sign_in_form")),
                (e = document.querySelector("#kt_sign_in_submit")),
                (r = FormValidation.formValidation(t, {
                    fields: {
                        email_or_username: {
                            validators: {
                                notEmpty: {
                                    message: "Isi email terlebih dahulu",
                                },
                            },
                        },
                        password: {
                            validators: {
                                notEmpty: {
                                    message: "Isi password terlebih dahulu",
                                },
                            },
                        },
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: ".fv-row",
                            eleInvalidClass: "",
                            eleValidClass: "",
                        }),
                    },
                })),
                !(function (t) {
                    try {
                        return new URL(t), !0;
                    } catch (t) {
                        return !1;
                    }
                })(e.closest("form").getAttribute("action"));
            e.addEventListener("click", function (i) {
                i.preventDefault(),
                    r.validate().then(function (r) {
                        "Valid" == r
                            ? (e.setAttribute("data-kt-indicator", "on"),
                              (e.disabled = !0),
                              axios
                                  .post(
                                      e.closest("form").getAttribute("action"),
                                      new FormData(t)
                                  )
                                  .then(function (e) {
                                      $.ajaxSetup({
                                          headers: {
                                              "X-CSRF-TOKEN": $(
                                                  'meta[name="csrf-token"]'
                                              ).attr("content"),
                                          },
                                      });
                                      var isi = {
                                          password: $("#pass").val(),
                                          email_or_username: $("#emails").val(),
                                      };
                                      $.ajax({
                                          url: "/post-login",
                                          method: "POST",
                                          dataType: "json",
                                          data: isi,
                                          success: function (data) {
                                            if (data.success == true) {
                                                Swal.fire({
                                                    text: data.message,
                                                    icon: "success",
                                                });
                                                setTimeout(function () {
                                                    window.location.href = data.route;
                                                }, 1500);
                                            }else{
                                                Swal.fire({
                                                    text: data.message,
                                                    icon: "error",
                                                    buttonsStyling: !1,
                                                    confirmButtonText:
                                                        "Ok, got it!",
                                                    customClass: {
                                                        confirmButton:
                                                            "btn btn-primary",
                                                    },
                                                });
                                            }
                                          },
                                          error: function (data) {
                                              Swal.fire({
                                                  text: data.message,
                                                  icon: "error",
                                                  buttonsStyling: !1,
                                                  confirmButtonText:
                                                      "Ok, got it!",
                                                  customClass: {
                                                      confirmButton:
                                                          "btn btn-primary",
                                                  },
                                              });
                                          },
                                      });
                                  })
                                  .catch(function (t) {
                                      Swal.fire({
                                          text: t.response.data.message,
                                          icon: "error",
                                          buttonsStyling: !1,
                                          confirmButtonText: "Ok, got it!",
                                          customClass: {
                                              confirmButton: "btn btn-primary",
                                          },
                                      });
                                  })
                                  .then(() => {
                                      e.removeAttribute("data-kt-indicator"),
                                          (e.disabled = !1);
                                  }))
                            : Swal.fire({
                                  text: "Silahkan isi terlebih dahulu",
                                  icon: "error",
                                  buttonsStyling: !1,
                                  confirmButtonText: "Ok, got it!",
                                  customClass: {
                                      confirmButton: "btn btn-primary",
                                  },
                              });
                    });
            });
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTSigninGeneral.init();
});
