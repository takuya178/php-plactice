class RenameComponentColumnToMains < ActiveRecord::Migration[6.0]
  def change
    rename_column :mains, :component, :genre
  end
end
