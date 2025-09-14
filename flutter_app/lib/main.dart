import 'package:flutter/material.dart';
import 'models/item.dart';
import 'services/cost_calculator.dart';
import 'widgets/drawing_painter.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Door Window Estimator',
      theme: ThemeData(primarySwatch: Colors.blue),
      home: const HomePage(),
    );
  }
}

class HomePage extends StatefulWidget {
  const HomePage({super.key});

  @override
  State<HomePage> createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  late Future<CostCalculator> _calculator;

  @override
  void initState() {
    super.initState();
    _calculator = CostCalculator.load();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text('Estimator')),
      body: Center(
        child: FutureBuilder<CostCalculator>(
          future: _calculator,
          builder: (context, snapshot) {
            if (!snapshot.hasData) {
              return const CircularProgressIndicator();
            }
            final item = Item(type: ItemType.doorSingle, widthMm: 900, heightMm: 2100);
            final cost = snapshot.data!.calculate(item);
            return Column(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                SizedBox(
                  width: 100,
                  height: 200,
                  child: CustomPaint(painter: DoorPainter(item)),
                ),
                Text('Total: ' + cost.total.toStringAsFixed(2)),
              ],
            );
          },
        ),
      ),
    );
  }
}
