import 'package:flutter_test/flutter_test.dart';
import 'package:door_window_estimator/models/item.dart';
import 'package:door_window_estimator/services/cost_calculator.dart';

void main() {
  test('cost calculation basic', () async {
    final calc = await CostCalculator.load();
    final item = Item(type: ItemType.doorSingle, widthMm: 800, heightMm: 2000);
    final result = calc.calculate(item);
    expect(result.total, greaterThan(0));
  });
}
