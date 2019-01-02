API Reference for Cryptocompare
------------
Here the complete list of api implemented now.

|  Cryptocompare api | Gateway name | Method name|
|---|---|---|
| Single Symbol Price  | price  | getSingleSymbolPrice()  |
| Multiple Symbols Price  | price  | getMultiSymbolPrice()  |
| Multiple Symbols Full Data  | price  | getMultiSymbolPriceFull() |
| Generate Custom Average  | price  | getCustomAverage()  |
||||Historical Data
| Historical Daily OHLCV  | historical  | getHistoricalDaily()  |
| Historical Hourly OHLCV  | historical  | getHistoricalHourly()  |
| Historical Minute OHLCV  | historical  | getHistoricalMinute() |
| Historical Day OHLCV for a timestamp  | historical  | getHistoricalDailyForTimestamp()  |
| Historical Day Average Price  | historical | getHistoricalDayAveragePrice() |
||||Toplists
| Toplist by 24H Volume Full Data  | toplist  | getToplistVolumeFullData() |
| Toplist by Market Cap Full Data  | toplist  | getToplistMarketCapFullData() |
| Top Exchanges Volume Data by Pair  | toplist  | getTopExchangesVolumeDataPair()  |
| Top Exchanges Full Data By Pair  | toplist  | getTopExchangesFullDataPair() |
| Toplist by Pair Volume | toplist  | getToplistPairVolume() |
| Toplist of Trading Pairs | toplist  | getToplistTradingPairs() |
|  |   |   |General Info
| Rate limit  | general  | getRateLimit()  |
| All the Exchanges and Trading Pairs  | general  | getAllExchangesAndTradingPairs()  |
| All the Coins  | general  | getAllCoins()  |
| All Exchanges General Info  | general  | getAllExchangeGeneralInfo()  |
| All Wallets General Info  | general  | getAllWalletGeneralInfo()  |
| All Crypto Cards General Info  |general   | getAllCryptoCardGeneralInfo()  |


TODO List 
---------

- [ ] Implementing the remaining API left
- [ ] Add it to the docs reference
