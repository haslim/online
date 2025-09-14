enum ItemType { doorSingle, window }

class Item {
  final ItemType type;
  final double widthMm;
  final double heightMm;
  final int quantity;
  final String glassType;

  Item({
    required this.type,
    required this.widthMm,
    required this.heightMm,
    this.quantity = 1,
    this.glassType = 'double',
  });

  double get areaM2 => (widthMm / 1000) * (heightMm / 1000) * quantity;
  double get perimeterM => 2 * ((widthMm + heightMm) / 1000) * quantity;
}
