$(document).ready((function(){var n=$("#basicRadio"),o=$("#cronRadio"),d=$(".cronFormat"),e=$(".basicFormat");n.is(":checked")&&(e.removeClass("d-none"),d.addClass("d-none")),o.is(":checked")&&(d.removeClass("d-none"),e.addClass("d-none")),o.on("click",(function(){d.removeClass("d-none"),e.addClass("d-none")})),n.on("click",(function(){e.removeClass("d-none"),d.addClass("d-none")}))}));
//# sourceMappingURL=interval-format-toggle.js.map