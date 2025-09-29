# Analyse de l'impact de l'imputation par la médiane sur les performances des modèles de régression

# 1. Importation des bibliothèques
import numpy as np
import pandas as pd
import matplotlib.pyplot as plt
import seaborn as sns
from sklearn.datasets import fetch_california_housing
from sklearn.model_selection import train_test_split
from sklearn.impute import SimpleImputer
from sklearn.preprocessing import StandardScaler
from sklearn.metrics import mean_absolute_error, mean_squared_error, r2_score
from sklearn.svm import SVR
from sklearn.ensemble import GradientBoostingRegressor
from sklearn.neighbors import KNeighborsRegressor
from sklearn.tree import DecisionTreeRegressor

# 2. Chargement et préparation des données
housing = fetch_california_housing(as_frame=True)
df = housing.frame

# Simulation de valeurs manquantes pour l'exercice
np.random.seed(42)
missing_mask = np.random.rand(*df.shape) < 0.1  # 10% de valeurs manquantes
df_masked = df.mask(missing_mask)

# Séparation des features et de la cible
X = df_masked.drop(columns="MedHouseVal")
y = df_masked["MedHouseVal"]

# Imputation par la médiane
imputer = SimpleImputer(strategy="median")
X_imputed = imputer.fit_transform(X)

# Remise en DataFrame avec noms de colonnes
X_imputed_df = pd.DataFrame(X_imputed, columns=X.columns)

# Split des données
X_train, X_test, y_train, y_test = train_test_split(X_imputed_df, y, test_size=0.2, random_state=42)

# Normalisation
scaler = StandardScaler()
X_train_scaled = scaler.fit_transform(X_train)
X_test_scaled = scaler.transform(X_test)

# 3. Définition des modèles
models = {
    "SVR": SVR(),
    "GradientBoosting": GradientBoostingRegressor(random_state=42),
    "KNN": KNeighborsRegressor(),
    "DecisionTree": DecisionTreeRegressor(random_state=42)
}

results = {}

# 4. Entraînement et évaluation des modèles
for name, model in models.items():
    model.fit(X_train_scaled, y_train)
    y_pred = model.predict(X_test_scaled)

    mae = mean_absolute_error(y_test, y_pred)
    rmse = np.sqrt(mean_squared_error(y_test, y_pred))
    r2 = r2_score(y_test, y_pred)

    results[name] = {"MAE": mae, "RMSE": rmse, "R2": r2, "y_pred": y_pred}

    # Visualisations
    plt.figure(figsize=(10, 4))
    plt.subplot(1, 2, 1)
    sns.histplot(y_test - y_pred, bins=30, kde=True)
    plt.title(f"Distribution des résidus - {name}")

    plt.subplot(1, 2, 2)
    plt.scatter(y_test, y_pred, alpha=0.5)
    plt.xlabel("y_test")
    plt.ylabel("y_pred")
    plt.title(f"y_test vs y_pred - {name}")
    plt.tight_layout()
    plt.show()

# 5. Affichage des résultats
results_df = pd.DataFrame(results).T
print("\nRésultats des modèles avec imputation par la médiane :")
print(results_df[["MAE", "RMSE", "R2"]])
# Analyse de l'impact de l'imputation par la médiane sur les performances des modèles de régression

# 1. Importation des bibliothèques
import numpy as np
import pandas as pd
import matplotlib.pyplot as plt
import seaborn as sns
from sklearn.datasets import fetch_california_housing
from sklearn.model_selection import train_test_split
from sklearn.impute import SimpleImputer
from sklearn.preprocessing import StandardScaler
from sklearn.metrics import mean_absolute_error, mean_squared_error, r2_score
from sklearn.svm import SVR
from sklearn.ensemble import GradientBoostingRegressor
from sklearn.neighbors import KNeighborsRegressor
from sklearn.tree import DecisionTreeRegressor

# 2. Chargement et préparation des données
housing = fetch_california_housing(as_frame=True)
df = housing.frame

# Simulation de valeurs manquantes pour l'exercice
np.random.seed(42)
missing_mask = np.random.rand(*df.shape) < 0.1  # 10% de valeurs manquantes
df_masked = df.mask(missing_mask)

# Séparation des features et de la cible
X = df_masked.drop(columns="MedHouseVal")
y = df_masked["MedHouseVal"]

# Imputation par la médiane
imputer = SimpleImputer(strategy="median")
X_imputed = imputer.fit_transform(X)

# Remise en DataFrame avec noms de colonnes
X_imputed_df = pd.DataFrame(X_imputed, columns=X.columns)

# Split des données
X_train, X_test, y_train, y_test = train_test_split(X_imputed_df, y, test_size=0.2, random_state=42)

# Normalisation
scaler = StandardScaler()
X_train_scaled = scaler.fit_transform(X_train)
X_test_scaled = scaler.transform(X_test)

# 3. Définition des modèles
models = {
    "SVR": SVR(),
    "GradientBoosting": GradientBoostingRegressor(random_state=42),
    "KNN": KNeighborsRegressor(),
    "DecisionTree": DecisionTreeRegressor(random_state=42)
}

results = {}

# 4. Entraînement et évaluation des modèles
for name, model in models.items():
    model.fit(X_train_scaled, y_train)
    y_pred = model.predict(X_test_scaled)

    mae = mean_absolute_error(y_test, y_pred)
    rmse = np.sqrt(mean_squared_error(y_test, y_pred))
    r2 = r2_score(y_test, y_pred)

    results[name] = {"MAE": mae, "RMSE": rmse, "R2": r2, "y_pred": y_pred}

    # Visualisations
    plt.figure(figsize=(10, 4))
    plt.subplot(1, 2, 1)
    sns.histplot(y_test - y_pred, bins=30, kde=True)
    plt.title(f"Distribution des résidus - {name}")

    plt.subplot(1, 2, 2)
    plt.scatter(y_test, y_pred, alpha=0.5)
    plt.xlabel("y_test")
    plt.ylabel("y_pred")
    plt.title(f"y_test vs y_pred - {name}")
    plt.tight_layout()
    plt.show()

# 5. Affichage des résultats
results_df = pd.DataFrame(results).T
print("\nRésultats des modèles avec imputation par la médiane :")
print(results_df[["MAE", "RMSE", "R2"]])
