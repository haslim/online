import 'package:google_mlkit_text_recognition/google_mlkit_text_recognition.dart';
import '../models/item.dart';

class OcrService {
  final TextRecognizer _textRecognizer = TextRecognizer();

  Future<List<Item>> processImage(InputImage image) async {
    // TODO: Parse recognized text and convert to Item objects
    final recognised = await _textRecognizer.processImage(image);
    // Placeholder: return empty list until parsing implemented
    return [];
  }

  void dispose() {
    _textRecognizer.close();
  }
}
