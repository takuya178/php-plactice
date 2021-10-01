class AddColumnsToFoodIntermediates < ActiveRecord::Migration[6.0]
  def change
    add_column :food_intermediates, :prices, :integer
  end
end
