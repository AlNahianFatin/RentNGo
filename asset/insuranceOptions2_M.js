class Insurance {
  static validate(tier, deductible, scenario) {
    if (!tier) {
      return "❌ Please select a coverage tier.";
    }
    if (deductible === "") {
      return "❌ Please enter a deductible amount.";
    }
    let deductibleNum = Number(deductible);
    if (isNaN(deductibleNum) || deductibleNum < 0) {
      return "❌ Deductible must be a positive number.";
    }
    if (!scenario) {
      return "❌ Please describe a claim scenario.";
    }
    return null;
  }
}
