class Damage {
  static validate(vehicleId, damageType, photoCount, signature) {
    if (!vehicleId) {
      return "❌ Vehicle ID is required.";
    }
    if (!signature) {
      return "❌ Signature is required.";
    }
    if (!damageType && photoCount === 0) {
      return "❌ Please select a damage type or upload a damage photo.";
    }
    return null;
  }
}
