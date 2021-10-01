class ChangeFoodIntermediatesToFoodCombinations < ActiveRecord::Migration[6.0]
  def change
    rename_table :food_intermediates, :food_combinations
  end
end
