class Booking {
  static validate(pickupDate, pickupTime, returnDate, returnTime) {
    let pickup = new Date(pickupDate + "T" + pickupTime);
    let ret = new Date(returnDate + "T" + returnTime);
    let now = new Date();

    if (isNaN(pickup) || isNaN(ret)) { // nan returns true if value is not a number
      return "Please fill in all date and time fields.";
    }
    if (pickup < now) {
      return "Pickup date/time cannot be in the past.";
    }
    if (ret <= pickup) {
      return "Return date/time must be after pickup.";
    }
    return null; // no errors
  }
}
