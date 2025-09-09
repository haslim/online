import 'dart:convert';
import 'package:flutter/services.dart' show rootBundle;
import '../models/item.dart';

class CostBreakdown {
  final double profileCost;
  final double glassCost;
  final double accessoryCost;
  final double laborCost;
  final double markup;
  final double vat;
  final double total;

  CostBreakdown({
    required this.profileCost,
    required this.glassCost,
    required this.accessoryCost,
    required this.laborCost,
    required this.markup,
    required this.vat,
    required this.total,
  });
}

class CostCalculator {
  final Map<String, dynamic> _config;
  CostCalculator._(this._config);

  static Future<CostCalculator> load() async {
    final data = await rootBundle.loadString('assets/maliyet_konfig_sablonu_v2.json');
    final json = jsonDecode(data) as Map<String, dynamic>;
    return CostCalculator._(json);
  }

  CostBreakdown calculate(Item item) {
    final priceSets = _config['price_sets'];
    final types = _config['types'];
    final accessories = _config['accessories'];

    final typeInfo = types[item.type.name] ?? {};
    final accessoryKey = typeInfo['accessory'];

    final area = item.areaM2;
    final perimeter = item.perimeterM;

    final profileCost = perimeter * (priceSets['profil_per_meter'] as num).toDouble();
    final glassCost = area * (priceSets['glass_per_m2'] as num).toDouble();
    final accessoryCost = (accessories[accessoryKey] as num?)?.toDouble() ?? 0;
    final laborCost = area * (priceSets['labor_per_m2'] as num).toDouble();

    final subtotal = profileCost + glassCost + accessoryCost + laborCost;
    final markupRate = (typeInfo['markup'] as num?)?.toDouble() ?? 0;
    final markup = subtotal * markupRate;
    final vatRate = (priceSets['vat'] as num).toDouble();
    final vat = (subtotal + markup) * vatRate;
    final total = subtotal + markup + vat;

    return CostBreakdown(
      profileCost: profileCost,
      glassCost: glassCost,
      accessoryCost: accessoryCost,
      laborCost: laborCost,
      markup: markup,
      vat: vat,
      total: total,
    );
  }
}
