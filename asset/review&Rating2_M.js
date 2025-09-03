class Review {
  static validate(name, rating, comment) {
    if (name === "") {
      return "❌ Name is required.";
    }
    if (rating === "") {
      return "❌ Please select a rating.";
    }
    if (comment.length < 10) {
      return "❌ Comment must be at least 10 characters.";
    }
    return null;
  }
}
