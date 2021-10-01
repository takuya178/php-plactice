class AddStoresToFoodIntermediates < ActiveRecord::Migration[6.0]
  def change
    add_column :food_intermediates, :stores, :integer, default: 0
  end
end
