require "csv"

CSV.foreach('db/fixtures/06_sub.csv', headers: true) do |row|
  Sub.create(
    name: row['name'],
    calorie: row['calorie'],
    sugar: row['sugar'],
    lipid: row['lipid'],
    salt: row['salt'],
    image: row['image']
  )
end
