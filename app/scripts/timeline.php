<script>
document.addEventListener("DOMContentLoaded", () => {
  // Toggle comment form on icon click
  document.querySelectorAll(".toggle-comment-btn").forEach(button => {
    button.addEventListener("click", () => {
      console.log("button working")
      const postId = button.dataset.postId;
      const formDiv = document.getElementById(`comment-form-${postId}`);
      formDiv.style.display = formDiv.style.display === "none" ? "block" : "none";
      formDiv.querySelector("textarea").focus();
    });
  });

  // Submit post on Enter (textarea must not be multiline)
  document.querySelector("form[action='/create_post'] textarea").addEventListener("keydown", function(e) {
    if (e.key === "Enter" && !e.shiftKey) {
      e.preventDefault();
      this.form.submit();
    }
  });

  // Submit comment on Enter
  document.querySelectorAll(".comment-form-element textarea").forEach(textarea => {
    textarea.addEventListener("keydown", function(e) {
      if (e.key === "Enter" && !e.shiftKey) {
        e.preventDefault();
        this.form.submit();
      }
    });
  });
})
</script>
