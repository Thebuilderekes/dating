document.addEventListener("DOMContentLoaded", () => {
  // Toggle comment form on button click
  document.querySelectorAll(".toggle-comment-btn").forEach(button => {
    const targetSelector = button.dataset.target;
    const target = document.querySelector(targetSelector);

    if (!target) return;

    // Accessibility: associate the button with the form it's toggling
    button.setAttribute("aria-controls", target.id);
    button.setAttribute("aria-expanded", target.hidden ? "false" : "true");

    button.addEventListener("click", () => {
      const isHidden = target.hidden;
      console.log("btn working")
      target.hidden = !isHidden;
      button.setAttribute("aria-expanded", String(isHidden));

      if (!isHidden) return; // Don't focus if hiding
      const textarea = target.querySelector("textarea");
      if (textarea) textarea.focus();
    });
  });

  // Submit post on Enter (single-line)
  const postTextarea = document.querySelector("form[action='/create_post'] textarea");
  if (postTextarea) {
    postTextarea.addEventListener("keydown", function(e) {
      if (e.key === "Enter" && !e.shiftKey) {
        e.preventDefault();
        this.form.submit();
      }
    });
  }

  // Submit comment on Enter (single-line)
  document.querySelectorAll(".comment-form-element textarea").forEach(textarea => {
    textarea.addEventListener("keydown", function(e) {
      if (e.key === "Enter" && !e.shiftKey) {
        e.preventDefault();
        this.form.submit();
      }
    });
  });
});


