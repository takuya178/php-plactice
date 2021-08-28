class CreateMains < ActiveRecord::Migration[6.0]
  def change
    create_table :mains do |t|
      t.string :name
      t.string :image
      t.integer :component, null: false, default: 0
      t.integer :calorie
      t.float :sugar
      t.float :lipid
      t.float :salt

      t.timestamps
    end
  end
end
