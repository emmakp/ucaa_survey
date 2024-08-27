document.addEventListener("DOMContentLoaded", function () {
  const progressListItems = document.querySelectorAll("#progressbar li");
  const progressBar = document.querySelector(".progress-bar");
  let currentStep = 0;

  function updateProgress() {
    const percent = (currentStep / (progressListItems.length - 1)) * 100;
    progressBar.style.width = percent + "%";

    progressListItems.forEach((item, index) => {
      if (index === currentStep) {
        item.classList.add("active");
      } else {
        item.classList.remove("active");
      }
    });
  }

  function showStep(stepIndex) {
    const steps = document.querySelectorAll(".step-container fieldset");

    // Fade out the current step
    steps[currentStep].classList.add("fade-out");

    setTimeout(() => {
      // Hide all steps
      steps.forEach((step) => {
        step.style.display = "none";
        step.classList.remove("fade-in", "fade-out");
      });

      // Show the target step
      steps[stepIndex].style.display = "block";
      steps[stepIndex].classList.add("fade-in");
    }, 300); // This delay matches the fade-out duration
  }

  function nextStep(button) {
    button.disabled = true;
    const originalText = button.value;
    button.value = "Loading...";

    setTimeout(() => {
      if (currentStep < progressListItems.length - 1) {
        currentStep++;
        showStep(currentStep);
        updateProgress();
      }

      button.value = originalText;
      button.disabled = false;
    }, 900);
  }

  function prevStep(button) {
    button.disabled = true;

    setTimeout(() => {
      if (currentStep > 0) {
        currentStep--;
        showStep(currentStep);
        updateProgress();
      }
      button.disabled = false;
    }, 900);
  }

  const nextStepButtons = document.querySelectorAll(".next-step");
  const prevStepButtons = document.querySelectorAll(".previous-step");

  nextStepButtons.forEach((button) => {
    button.addEventListener("click", function () {
      nextStep(button);
    });
  });

  prevStepButtons.forEach((button) => {
    button.addEventListener("click", function () {
      prevStep(button);
    });
  });

  showStep(currentStep);
});
