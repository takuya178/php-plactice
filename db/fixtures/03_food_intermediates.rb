require "csv"

CSV.foreach('db/fixtures/', headers: true) do |row|
  FoodIntermediates.create(
    main_id: row['main_id'],
    sub_id: row['sub_id'],
    genre: row['genre']
  )
end