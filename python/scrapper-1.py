from fusion_solar_py.client import FusionSolarClient
import requests
import datetime

user = 'BRICORAMA'
password = 'Mathilde26*'
customerId = 1

client = FusionSolarClient(
user,
password,
huawei_subdomain="uni005eu5",
captcha_model_path="../captcha_huawei.onnx"
)

stats = client.get_power_status()

date = datetime.datetime.now().strftime('%Y-%m-%dT%H:%M:%S.%f')
currentPower = stats.current_power_kw
energyToday = stats.energy_today_kwh
energyTotal = stats.energy_kwh

# Calculate tree and CO2
co2Tonne = round(energyTotal * 238 / 1000 / 1000)
threes = round(co2Tonne * 1000 / 25)

payload = {'createdAt': date, 'production': currentPower, 'productionDay': energyToday, 'productionTotal': energyTotal, 'co2': co2Tonne, 'threes': threes, 'customer': customerId}
r = requests.post("http://127.0.0.1:8000/api/data", data=payload)

# log out - just in case
client.log_out()