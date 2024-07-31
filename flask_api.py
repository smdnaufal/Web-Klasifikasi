import joblib
import numpy as np
import pandas as pd
from flask import Flask, request, jsonify

app = Flask(__name__)

# Load model terbaik
model = joblib.load('best_model.pkl')

# Define the feature names
feature_names = [
    'Pekerjaan Ayah', 'Pekerjaan Ibu', 'Penghasilan Ayah', 'Penghasilan Ibu',
    'Total Tabungan', 'Kepemilikan Rumah', 'Sumber Listrik', 'DAYA LISTRIK',
    'Luas Rumah', 'Bahan Atap', 'Bahan Tembok', 'Sumber Air Utama',
    'Jumlah Orang Tinggal', 'Rencana Tinggal', 'Biaya Transportasi',
    'Transportasi Harian', 'Ranking Saat Sekolah', 'Total Rerata Nilai Rapor',
    'IP Semester'
]

@app.route('/predict', methods=['POST'])
def predict():
    data = request.get_json(force=True)
    
    # Extract features and convert to numeric
    features = {
        'Pekerjaan Ayah': float(data['Pekerjaan Ayah']),
        'Pekerjaan Ibu': float(data['Pekerjaan Ibu']),
        'Penghasilan Ayah': float(data['Penghasilan Ayah']),
        'Penghasilan Ibu': float(data['Penghasilan Ibu']),
        'Total Tabungan': float(data['Total Tabungan']),
        'Kepemilikan Rumah': float(data['Kepemilikan Rumah']),
        'Sumber Listrik': float(data['Sumber Listrik']),
        'DAYA LISTRIK': float(data['DAYA LISTRIK']),
        'Luas Rumah': float(data['Luas Rumah']),
        'Bahan Atap': float(data['Bahan Atap']),
        'Bahan Tembok': float(data['Bahan Tembok']),
        'Sumber Air Utama': float(data['Sumber Air Utama']),
        'Jumlah Orang Tinggal': float(data['Jumlah Orang Tinggal']),
        'Rencana Tinggal': float(data['Rencana Tinggal']),
        'Biaya Transportasi': float(data['Biaya Transportasi']),
        'Transportasi Harian': float(data['Transportasi Harian']),
        'Ranking Saat Sekolah': float(data['Ranking Saat Sekolah']),
        'Total Rerata Nilai Rapor': float(data['Total Rerata Nilai Rapor']),
        'IP Semester': float(data['IP Semester'])
    }
    
    # Convert to DataFrame
    final_features = pd.DataFrame([features], columns=feature_names)

    # Predict
    prediction = model.predict(final_features)
    
    return jsonify({'prediction': int(prediction[0])})

if __name__ == '__main__':
    app.run(debug=True)
