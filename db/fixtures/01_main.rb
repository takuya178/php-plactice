require "csv"

CSV.foreach('db/fixtures/05_main.csv', headers: true) do |row|
  Main.create(
    name: row['name'],
    calorie: row['calorie'],
    sugar: row['sugar'],
    lipid: row['lipid'],
    salt: row['salt'],
    price: row['price'],
    image: row['image']
  )
end

CSV.foreach('db/fixtures/06_sub.csv', headers: true) do |row|
  Sub.create(
    name: row['name'],
    calorie: row['calorie'],
    sugar: row['sugar'],
    lipid: row['lipid'],
    salt: row['salt'],
    price: row['price'],
    image: row['image']
  )
end
