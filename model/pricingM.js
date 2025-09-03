class Pricing {
  static dailyRates = {
    Premio: 50,
    Prado: 80,
    Hiace: 70,
    BMW: 120,
    Allion: 45
  };

  static calculate(startDate, endDate, vehicleType) {
    let start = new Date(startDate);
    let end = new Date(endDate);

    if (isNaN(start) || isNaN(end) || !vehicleType || end <= start) {
      return null;
    }

    let days = (end - start) / (1000 * 60 * 60 * 24);
    let rate = this.dailyRates[vehicleType] || 0;
    return days * rate;
  }

  static validate(startDate, endDate, vehicleType) {
    if (!startDate || !endDate || !vehicleType) {
      return "❌ Please fill in all fields.";
    }

    let start = new Date(startDate);
    let end = new Date(endDate);

    if (isNaN(start) || isNaN(end)) {
      return "❌ Invalid dates.";
    }
    if (end <= start) {
      return "❌ End date must be after start date.";
    }
    return null; 
  }
}
