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
print(payload)
r = requests.post("http://127.0.0.1:8000/api/data", data=payload)

print(r.text)
#plant_overview = client.get_station_list()

# get the current power of your first plant
#print(f"Current power production: { plant_overview[0]['currentPower'] }")

# alternatively, you can get time resolved data for each plant:

# get the plant ids
#plant_ids = client.get_plant_ids()

#print(f"Found {len(plant_ids)} plants")

# get the basic (current) overview data for the plant
#plant_overview = client.get_current_plant_data(plant_ids[0])

#print(str(plant_overview))

# get the data for the first plant
#plant_data = client.get_plant_stats(plant_ids[0])

# plant_data is a dict that contains the complete
# usage statistics of the current day. There is
# a helper function available to extract some
# most recent measurements
#last_values = client.get_last_plant_data(plant_data)

#print(last_values)

# log out - just in case
client.log_out()